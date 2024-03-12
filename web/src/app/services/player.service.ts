import { Injectable } from '@angular/core';
import { User } from '../interfaces/user';
import { Player } from '../interfaces/player';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PlayerService {

  private playerURL = 'http://127.0.0.1:8000/api/auth/jugadores'
  constructor(private http: HttpClient) { }

  createPlayer(user_id: Number, nombre: string): Observable<Player>{
    return this.http.post<Player>(this.playerURL, { nombre: nombre, user_id: user_id })
  }

  getPlayerData(user_id: Number): Observable<Player> {
    return this.http.get<Player>(this.playerURL + "/" + user_id)
  }
}
