import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class JugadoresService {

  private getJugadoresURL = `${api}/api/auth/`

  constructor(private http: HttpClient) { }

  getAllPlayers()  {
    return this.http.get(this.getJugadoresURL)
  }
}
