import { Injectable } from '@angular/core';
import { api } from '../interfaces/env';
import { Observable } from 'rxjs';
import { Clanes } from '../interfaces/clanes';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ClanesService {

  private getClanesURL = `${api}/api/user/clan/show/all`
  private deleteClanURL = `${api}/api/user/clan/delete/`
  private serverSent = `${api}/api/stream-clan`

  constructor( private http: HttpClient ) { }

  getClanes(): Observable<Clanes[]> {
    return this.http.get<Clanes[]>(this.getClanesURL);
  }
  deleteClan(id: Number) {
    return this.http.delete(this.deleteClanURL + id)
  }

  serverClanes(): Observable<Clanes[]> {
    return this.http.get<Clanes[]>(this.serverSent)
  }
}
