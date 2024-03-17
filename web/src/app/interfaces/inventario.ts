export interface Inventario {

    user: Number;
    arma:{
        id: Number;
        nombre: string;
		tipo:string;
		rareza:string;
		danio_base:Number;
    }

    heroe:{

        id:Number;
        nombre:string
        tipo:string
        rareza:string
        habilidad_especial:string;

    }

}
