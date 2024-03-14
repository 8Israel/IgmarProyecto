import { UserData } from "./user-data";
export interface UsersResponse {
    message: string;
    users: UserData[];
}