import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { UserData } from '../interfaces/user-data';
import { UsersResponse } from '../interfaces/users-response';
import { UserById } from '../interfaces/user-by-id';
import { Roles } from '../interfaces/roles';
import { UserUpdate } from '../interfaces/user-update';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private GetUsersURL = 'http://127.0.0.1:8000/api/user/index'
  private getUserURL = 'http://127.0.0.1:8000/api/user/index/'
  private updateUserURL = 'http://127.0.0.1:8000/api/user/update/'
  private deleteUserURL = 'http://127.0.0.1:8000/api/user/delete/'
  private getRolesURL = 'http://127.0.0.1:8000/api/user/roles'


  private user: User = {
    data: {
      id: 0,
      name: "",
      email: "",
      role_id: 0
    },
    token: ""
  }
  constructor(private http: HttpClient) { }

  setUser(user: User){
    this.user = user
  }

  getUser(): User {
    return this.user
  }

  getUserById(id: Number): Observable<UserById> {
    return this.http.get<UserById>(this.getUserURL + id)
  }

  getUsers(): Observable<UsersResponse> {
    return this.http.get<UsersResponse>(this.GetUsersURL)
  }
  
  getRoles(): Observable<Roles[]>{
    return this.http.get<Roles[]>(this.getRolesURL)
  }

  editUser(user: UserUpdate, id: Number): Observable<User> {
    return this.http.put<User>(this.updateUserURL + id, user )
  }

  deleteUser(id: Number): Observable<string> {
    return this.http.delete<string>(this.deleteUserURL + id)
  }
}
