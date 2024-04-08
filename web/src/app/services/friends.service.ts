import { Injectable } from '@angular/core';
import { Friend } from '../interfaces/friend';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class FriendsService {

  constructor(private http: HttpClient) { }

  private getFriendsURL = `${api}/api/user/friends`
  
  getFriends(): Observable<Friend[]> {
    return this.http.get<Friend[]>(this.getFriendsURL)
  }
}
