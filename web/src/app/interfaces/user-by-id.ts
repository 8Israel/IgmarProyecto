export interface UserById {
    message: string;
    users: {
        id: Number;
        name: string;
        email: string;
        role_id: Number;
        activate: Boolean
    }
}
