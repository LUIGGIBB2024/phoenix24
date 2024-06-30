<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enlacevisual_nv extends Model
{
    use HasFactory;
    protected $table = "enlacevisual_nv";

    protected $fillable = [
        'nombre','nit','direccion','email','telefono','correogerencia','correointerno1','correointerno2','correointerno3','UsuariosID','anofacturacion','anoinventarios','anocartera','anopagar','anocostos','anocontabilidad','anonomina','anovehiculos','anoabogados',
        'mesfacturacion','mescartera','mesinventarios','mespagar','mescontabilidad','mescostos','mesnomina','mesvehiculos','mesabogados','razonsocial','representantelegal','bodegadefecto','lotedefecto','configurarproducto','listaxdefecto','saldoinicialcaja',
        'utilizarlector','productoarriendos','productoadministracion','productocomisionadministracion','tipodeempresa','rutaimpcocina','rutaimpbar','	rutaimpcaja','cadenacortedepapel','texto1','texto2','texto3','texto4','texto5','texto6','texto7','texto8',
        'texto9','texto10','msj_urlprimaria','msj_urlsecundaria','msj_apikey','msj_token','fel_tokenempresa','fel_tokenpassword','fel_urlproveedor','fel_urladjuntos','fel_urlreportes','porcentajepropina','factorpuntos','rutadefotosproductos','rutadefotosterceros',
        'rutadeimagenes','rutadereportes','otrosenlaces','nitrealempresa','dvrealempresa','utilizarrango','desde01','hasta01','desde02','	hasta02','hasta03','desde03','desde04','hasta04','minutosdegavela','minutosantes','codigoprestador','actvidadeconomica',
        'ciudad','pais','horadiadesde','horahasta','nc_cambiaringxdevolucion','valordomicilio','fel_manejafacturasfel','cuentaarrendatarios','cuentapropietarios','numerodecuenta1','numerodecuenta2','numerodecuenta3','numerodecuenta4','inv_cuentadeterioro',
        'inv_centrodeterioro','inv_scentrodeterioro','inv_dctodeterioro','inv_dctodereversion','inv_bodegadefecto','car_conceptodepago','car_conceptodeabono','car_conceptodeintereses','car_conceptodeinteresesdemora','car_conceptoseguro',
        'car_documentodecartera','car_cuentadebdeterioro','car_centrodebdeterioro','car_scentrodebdeteriorio','car_cuentacredeterioro','car_centrocredeterioro','car_scentrocredeterioro','car_documentodeterioro','car_documentoreversion',
        'car_interesesdemora','tes_nombredeltesorero','tes_clavemontocartera','tes_claveespecial1','tes_claveespecial2','tes_claveespecial3','tes_cuentaconsignacion','tes_centroconsignacion','tes_scentroconsignacion','tes_cuentadebdeterioro',
        'tes_centrodebdeterioro','tes_scentrodebdeterioro','tes_cuentacredeterioro','tes_centrocredeterioro','tes_scentrocredeterioro','	tes_documentodeterioro','tes_documentoreversion','documentopedido','documentocartera','password','smtp','puerto',
        'apikeygooglemap','apikeymapeo01','apikeymapeo02','apikeymapeo03','statuscontrol','usuario_created','usuario_updated','fecha_created','fecha_updated'];

    protected $primaryKey = "idempresa";
    public $timestamps = false;

    public function getKeyName()
    {
        return "idempresa";
    }
}
