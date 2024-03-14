import { Injectable } from '@angular/core';
import { Friend } from '../interfaces/friend';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FriendsService {

  constructor(private http: HttpClient) { }

  private getFriendsURL = "http://127.0.0.1:8000/api/user/friends"
  
  getFriends(): Observable<Friend[]> {
    return this.http.get<Friend[]>(this.getFriendsURL)
  }
}
