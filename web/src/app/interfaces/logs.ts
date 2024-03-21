export interface Logs {
    _id: Number;
    user_id: Number;
    user: {
        id: Number;
        name: string;
        role_id: Number
    }
    verb: string;
    data: any;
    date: string;
}
