import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Logs } from '../interfaces/logs';

@Injectable({
  providedIn: 'root'
})
export class LogsService {

  constructor(private http: HttpClient) { }
  private getLogsURL = 'http://127.0.0.1:8000/api/user/logs'

  getLogs(): Observable<Logs[]> {
    return this.http.get<Logs[]>(this.getLogsURL)
  }


}
