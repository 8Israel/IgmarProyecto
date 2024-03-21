import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class MisionesCompletadasService {

  constructor(private http: HttpClient) { }
  private completarMisionURL = 'http://127.0.0.1:8000/user/misiones/completar'
}
