import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Heroes } from '../interfaces/heroes';

@Injectable({
  providedIn: 'root'
})
export class HeroesService {

  private getHeroesURL = "http://127.0.0.1:8000/api/user/heroes/index"
  constructor(private http: HttpClient) { }

  getHeroes(): Observable<Heroes[]> {
    return this.http.get<Heroes[]>(this.getHeroesURL)
  }

}
