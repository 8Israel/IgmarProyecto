import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Misiones } from '../interfaces/misiones';

@Injectable({
  providedIn: 'root'
})
export class MisionesService {

  private getMisionesURL = 'http://127.0.0.1:8000/api/auth/misiones'
  constructor(private http: HttpClient) { }

  getMisiones(): Observable<Misiones[]> {
    return this.http.get<Misiones[]>(this.getMisionesURL)
  }
}
