<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;

class OrderController extends Controller
{
    /**
     * Affiche la liste des commandes.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::all(); // Récupère tous les clients
    
        if ($request->has('client_id') && $request->get('client_id') != '') {
            $orders = Order::where('client_id', $request->get('client_id'))->get();
        } else {
            $orders = Order::all(); 
        }
        
        // Renvoie la vue avec les commandes et les clients
        return view('order.index', compact('orders', 'clients')); 
    }
    


    /**
     * Stocke une nouvelle commande en base.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric|between:0,999999.99',
        ]);

        $order = Order::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Commande ajoutée avec succès",
            "data" => $order
        ]);
    }

    /**
     * Affiche une commande spécifique.
     */
    public function show(string $id)
    {
        $order = Order::find($id); 
    
        if (!$order) {
            return redirect('/orders')->with('error', 'Commande non trouvée');
        }
    
        return view('order.show', compact('order')); 
    }
    

    /**
     * Met à jour une commande spécifique en base.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        if (is_null($order)) {
            return response()->json([
                "success" => false,
                "message" => "Commande non trouvée"
            ], 404);
        }

        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric|between:0,999999.99',
            // Vous pouvez ajouter d'autres validations si besoin.
        ]);

        $order->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Commande mise à jour avec succès",
            "data" => $order
        ]);
    }

    /**
     * Supprime une commande spécifique de la base.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (is_null($order)) {
            return response()->json([
                "success" => false,
                "message" => "Commande non trouvée"
            ], 404);
        }

        $order->delete();

        return response()->json([
            "success" => true,
            "message" => "Commande supprimée avec succès"
        ]);
    }
}
