import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class JugadoresService {

  private getJugadoresURL = "http://127.0.0.1:8000/api/auth/"

  constructor(private http: HttpClient) { }

  getAllPlayers()  {
    return this.http.get(this.getJugadoresURL)
  }
}
