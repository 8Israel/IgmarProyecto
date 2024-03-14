import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { UserData } from '../interfaces/user-data';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private GetUsersURL = 'http://127.0.0.1:8000/api/user/index'


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



  getUsers(): Observable<UserData[]> {
    return this.http.get<UserData[]>(this.GetUsersURL)
  }

}
