import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Misiones } from '../interfaces/misiones';
import { CreateMision } from '../interfaces/create-mision';
import { MisionResponse } from '../interfaces/mision-response';

@Injectable({
  providedIn: 'root'
})
export class MisionesService {

  private getMisionesURL = 'http://127.0.0.1:8000/api/user/misiones/show'
  private createMisionesURL = 'http://127.0.0.1:8000/api/user/misiones/create'
  constructor(private http: HttpClient) { }

  getMisiones(): Observable<Misiones[]> {
    return this.http.get<Misiones[]>(this.getMisionesURL)
  }

  createMisiones(mision:CreateMision): Observable<MisionResponse> {
    return this.http.post<MisionResponse>(this.createMisionesURL,mision)
  }
}
