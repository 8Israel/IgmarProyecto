import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Login } from '../interfaces/login';
import { Observable } from 'rxjs';
import { User } from '../interfaces/user';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  // Declaración de variables y endpoints
  private loginURL = "http://127.0.0.1:8000/api/login";
  private token: string|null = null;
  private static instance: LoginService

  // Asignar instancia y obtenerla
  constructor(private http: HttpClient) {
    LoginService.instance = this;
  }
  public static getInstance(): LoginService{
    return LoginService.instance
  }

  // Obtener y setear token
  setToken(token: string|null){
    this.token = token
  }
  getToken(): string|null{
    return this.token
  }

  // Hacer petición a api
  LogIn(user: Login): Observable<User> {
    return this.http.post<User>(this.loginURL, user)
  }

  Verificar(): Observable<any> {
    let url = 'http://127.0.0.1:8000/api/auth/me'
    return this.http.post<any>(url, null)
  }


}
