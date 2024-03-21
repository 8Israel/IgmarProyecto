import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Armas } from '../interfaces/armas';

@Injectable({
  providedIn: 'root'
})
export class ArmasService {

  private getarmasURL = 'http://127.0.0.1:8000/api/user/armas/index'
  private updateArmasURL = 'http://127.0.0.1:8000/api/user/armas/update/'
  private createArmasURL = 'http://127.0.0.1:8000/api/user/armas/create'
  private deleteArmaURL = 'http://127.0.0.1:8000/api/user/armas/delete/'

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
