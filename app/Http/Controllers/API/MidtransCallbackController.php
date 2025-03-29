<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        // Log the notification details for debugging
        Log::info('Midtrans Notification:', [
            'status' => $status,
            'type' => $type,
            'fraud' => $fraud,
            'orderId' => $orderId,
        ]);

        // Extract the booking ID from the order ID
        $bookingId = explode('-', $orderId)[1];

        // Cari transaksi berdasarkan ID
        $booking = Booking::findOrFail($bookingId);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->payment_status = 'pending';
                } else {
                    $booking->payment_status = 'success';
                }
            }
        } elseif ($status == 'settlement') {
            $booking->payment_status = 'success';
        } elseif ($status == 'pending') {
            $booking->payment_status = 'pending';
        } elseif ($status == 'deny') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'expire') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'cancel') {
            $booking->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $booking->save();

        // Return response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }
}
