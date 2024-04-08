import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Inventario } from '../interfaces/inventario';
import { Editinventario } from '../interfaces/edit-inventario';
import { api } from '../interfaces/env';



@Injectable({
  providedIn: 'root'
})
export class InventarioService {

  private PutInventarioURL = `${api}/api/user/inventario/update`
  private GetInventarioURL = `${api}/api/user/inventario`

  constructor(private http:HttpClient) { }

  getInventario(): Observable<Inventario[]>{
    return this.http.get<Inventario[]>(this.GetInventarioURL)
  
  }

  getInventarioById(user_id: Number): Observable<Inventario[]> {
    return this.http.get<Inventario[]>(this.GetInventarioURL + '/' + user_id)
  }

  putInventario(arma_id:Number,heroe_id:Number): Observable<Editinventario>{
    return this.http.put<Editinventario>(this.PutInventarioURL,{arma_id:arma_id,heroe_id:heroe_id})
  
  }

}


