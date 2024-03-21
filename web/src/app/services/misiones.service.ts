import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Misiones } from '../interfaces/misiones-recompensas';
import { CreateMision } from '../interfaces/create-mision';
import { MisionResponse } from '../interfaces/mision-response';


@Injectable({
  providedIn: 'root'
})
export class MisionesService {

  private getMisionesURL =    'http://127.0.0.1:8000/api/user/misiones/show'
  private createMisionesURL = 'http://127.0.0.1:8000/api/user/misiones/create'
  private updateMisionesURL = 'http://127.0.0.1:8000/api/user/misiones/update/'
  private deleteMisionesURL = 'http://127.0.0.1:8000/api/user/misiones/delete/'

  constructor(private http: HttpClient) { }

  getMisiones(): Observable<Misiones[]> {
    return this.http.get<Misiones[]>(this.getMisionesURL)
  }

  getMisionById(id: Number): Observable<Misiones[]>{
    return this.http.get<Misiones[]>(this.getMisionesURL + '/' + id)
  }

  createMisiones(mision:CreateMision): Observable<MisionResponse> {
    return this.http.post<MisionResponse>(this.createMisionesURL,{nombre: mision.nombre, tipo: mision.tipo, recompensas_id: mision.recompensas_id})
  }

  deleteMisiones(id: Number) {
    return this.http.delete(this.deleteMisionesURL + id)
  }

  updateMisiones(mision: CreateMision) {
    return this.http.put(this.updateMisionesURL + mision.id, mision)
  }
}
