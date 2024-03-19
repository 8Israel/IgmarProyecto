export interface Me {
    id: Number,
    name: string,
    email: string,
    role_id: Number,
    activate: boolean,
    role: {
        id: Number,
        name: string
    }
}
