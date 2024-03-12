import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private user: User = {
    data: {
      id: 0,
      name: "",
      email: ""
    },
    token: ""
  }
  constructor() { }

  setUser(user: User){
    this.user = user
  }

  getUser(): User {
    return this.user
  }

}
