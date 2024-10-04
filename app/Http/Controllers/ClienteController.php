<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'saldo_devedor' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Cliente::create($request->all());
        return JsonResponse::success('Customer created successfully', $customer); 
    }

    
    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'saldo_devedor' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Cliente::findOrFail($id);
        $customer->update($request->all());

        return JsonResponse::success('Customer updated successfully', $customer); 
        
    }

    
    public function excluir($id)
    {
        $customer = Cliente::findOrFail($id);
        $customer->delete();
        return JsonResponse::success('Customer deleted successfully', $customer); 
    }

    
    public function listar()
    {
        $clientes = Cliente::all();
        return JsonResponse::success(data: $clientes);
    }

    
    public function listarPeloId($id)
    {
        $customer = Cliente::findOrFail($id);
        return JsonResponse::success('Customer find successfully', $customer); 
    }
}
