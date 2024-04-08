import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Heroes } from '../interfaces/heroes';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class HeroesService {

  private getHeroesURL = `${api}/api/user/heroes/index`
  constructor(private http: HttpClient) { }

  getHeroes(): Observable<Heroes[]> {
    return this.http.get<Heroes[]>(this.getHeroesURL)
  }

}
