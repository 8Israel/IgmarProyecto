import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { RecompensasService } from './../../services/recompensas.service';
import { Recompensas } from '../../interfaces/recompensas';




@Component({
  selector: 'app-recompensas',
  templateUrl: 'view-recompensas.component.html',
  styleUrls: ['view-recompensas.component.css']

})
export class RecompensasComponent implements OnInit {
  recompensas$: Observable<Recompensas[]> = new Observable<Recompensas[]>();

  constructor(private recompensaService: RecompensasService) { }

  ngOnInit() {
    this.recompensas$ = this.recompensaService.getRecompensas();
  }
}