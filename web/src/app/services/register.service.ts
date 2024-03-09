import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Register } from '../interfaces/register';
import { Observable } from 'rxjs';
import { User } from '../interfaces/user';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  private registerURL = 'http://127.0.0.1:8000/api/register'
  constructor(private http: HttpClient) { }

  Register(user: Register){
    return this.http.post(this.registerURL, user)
  }
}
