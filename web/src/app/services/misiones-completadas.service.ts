import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class MisionesCompletadasService {

  constructor(private http: HttpClient) { }
  private completarMisionURL = `${api}/user/misiones/completar`
}
