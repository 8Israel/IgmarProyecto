import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Recompensas } from '../interfaces/recompensas';
import { RecompensaResponse } from '../interfaces/recompensa-response';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class RecompensasService {

  private getRecompensasURL = `${api}/api/user/recompensas/index`
  private postRecompensasURL = `${api}/api/user/recompensas/create`
  constructor(private http:HttpClient) { }
  
  getRecompensas(): Observable<Recompensas[]> {
    return this.http.get<Recompensas[]>(this.getRecompensasURL)
  }

  createRecompensas(recompensa:Recompensas):Observable<RecompensaResponse>{
    return this.http.post<RecompensaResponse>(this.postRecompensasURL,recompensa)

  }


}
