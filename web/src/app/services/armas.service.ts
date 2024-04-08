import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Armas } from '../interfaces/armas';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class ArmasService {

  private getarmasURL = `${api}/api/user/armas/index`
  private updateArmasURL = `${api}/api/user/armas/update/`
  private createArmasURL = `${api}/api/user/armas/create`
  private deleteArmaURL = `${api}/api/user/armas/delete/`

  constructor(private http:HttpClient) { }

  getArmas():Observable<Armas[]>{
    return this.http.get<Armas[]>(this.getarmasURL)
  }

  getArmasById(id: Number): Observable<Armas>{
    return this.http.get<Armas>(this.getarmasURL + '/' + id);
  }

  updateArma(arma: Armas): Observable<string>{
    return this.http.put<string>(this.updateArmasURL + arma.id, arma)
  }
  createArma(arma: Armas): Observable<{message: ""}>{
    return this.http.post<{message: ""}>(this.createArmasURL, arma)
  }
  deleteArma(id: Number) {
    return this.http.delete(this.deleteArmaURL + id)
  }
}
