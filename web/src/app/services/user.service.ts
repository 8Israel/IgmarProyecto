import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private GetUsersURL = 'http://127.0.0.1:8000/api/auth/jugadores'

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

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.GetUsersURL)
  }

}
