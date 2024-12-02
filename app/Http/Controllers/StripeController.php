<?php

namespace App\Http\Controllers;

use App\Models\TipoAnalisis;
use Illuminate\Http\Request;


class StripeController extends Controller
{
    public function checkout()
    {
        $tiposAnalisis = TipoAnalisis::all();
        return view('VistaCheckout.checkout', compact('tiposAnalisis'));
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $ids_analisis = $request->input('analisis_id');
        $analisis = TipoAnalisis::whereIn('id', $ids_analisis)->get();

        // Construir los ítems de línea para la sesión de Stripe
        $lineItems = [];
        foreach ($analisis as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'BOB',
                    'product_data' => [
                        'name' => $item->nombre, // Nombre del análisis
                    ],
                    'unit_amount' => $item->precio * 100, // Convertir el precio a centavos (Stripe espera el precio en centavos)
                ],
                'quantity' => 1, // Puedes ajustar la cantidad según sea necesario
            ];
        }

        // Crear la sesión de Stripe con los ítems de línea
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        
        return redirect()->route('checkout')->with('success', 'Pago completado con éxito');
    }
}
