import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Register } from '../interfaces/register';
import { Observable } from 'rxjs';
import { User } from '../interfaces/user';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  private registerURL = `${api}/api/auth/register`
  constructor(private http: HttpClient) { }

  Register(user: Register){
    return this.http.post(this.registerURL, user)
  }
}
