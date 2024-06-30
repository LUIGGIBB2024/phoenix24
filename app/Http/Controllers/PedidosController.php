<?php
namespace App\Http\Controllers;
use App\Models\cliente;
use App\Models\detalledemiscelaneo;
use App\Models\Detalledepedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
      return view ('pedidos.index');
    }

    public function verdetalle($id)
    {
      $pedidos = Pedido::find($id);
      return view ('pedidos.verdetalle',compact('pedidos'));
    }

}
