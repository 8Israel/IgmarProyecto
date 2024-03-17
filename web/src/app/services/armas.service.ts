import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Armas } from '../interfaces/armas';

@Injectable({
  providedIn: 'root'
})
export class ArmasService {

  private getarmasURL = 'http://127.0.0.1:8000/api/user/armas/index'


  constructor(private http:HttpClient) { }

  getArmas():Observable<Armas[]>{

    return this.http.get<Armas[]>(this.getarmasURL)

  }
}
