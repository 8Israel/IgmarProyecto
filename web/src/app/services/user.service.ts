import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { UserData } from '../interfaces/user-data';
import { UsersResponse } from '../interfaces/users-response';
import { UserById } from '../interfaces/user-by-id';
import { Roles } from '../interfaces/roles';
import { UserUpdate } from '../interfaces/user-update';
import { Me } from '../interfaces/me';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private GetUsersURL = `${api}/api/user/index`
  private me = `${api}/api/user/me`
  private getUserURL = `${api}/api/user/index/`
  private updateUserURL = `${api}/api/user/update/`
  private deleteUserURL = `${api}/api/user/delete/`
  private getRolesURL = `${api}/api/user/roles`


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

  getUserData(): Observable<Me> {
    return this.http.get<Me>(this.me)
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
