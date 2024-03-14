export interface Friend {
    amigo: {
        id: Number;
        email: string;
        name: string;
        role_id: Number
    },
    estadisticas: {
        id: Number;
        nivel: Number;
        experiencia: Number;
        puntuacion: Number;
        user_id: Number
    }
}
