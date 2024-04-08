import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Login } from '../interfaces/login';
import { Observable } from 'rxjs';
import { User } from '../interfaces/user';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  // Declaración de variables y endpoints
  private loginURL = `${api}/api/auth/login`;
  private verificationCodeURL = `${api}/api/auth/verify-two-factor-code`
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
  LogIn(email: string, password: string): Observable<Login> {
    return this.http.post<Login>(this.loginURL, {email: email, password: password})
  }

  VerificarCodigo(two_factor_code: Number): Observable<User> {
    return this.http.post<User>(this.verificationCodeURL, {two_factor_code: two_factor_code})
  }

  VerificarAutenticacion(): Observable<any> {
    let url = `${api}/api/user/me`
    return this.http.get<any>(url)
  }


}
