export interface Misiones {
    id: Number;
    nombre: string;
    tipo: string;
    recompensa_id: Number;
    recompensa: {
        id: Number;
        tipo: string;
        xp: Number;
    }
}
