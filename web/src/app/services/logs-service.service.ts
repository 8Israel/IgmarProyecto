import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Logs } from '../interfaces/logs';
import { api } from '../interfaces/env';

@Injectable({
  providedIn: 'root'
})
export class LogsService {

  constructor(private http: HttpClient) { }
  private getLogsURL = `${api}/api/user/logs`

  getLogs(): Observable<Logs[]> {
    return this.http.get<Logs[]>(this.getLogsURL)
  }


}
