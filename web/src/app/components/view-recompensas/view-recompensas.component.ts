import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { RecompensasService } from './../../services/recompensas.service';
import { Recompensas } from '../../interfaces/recompensas';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from '../navbar/navbar.component';
import { RouterLink } from '@angular/router';




@Component({
  selector: 'app-recompensas',
  standalone: true,
  imports: [ FormsModule, CommonModule, NavbarComponent, RouterLink ],
  templateUrl: 'view-recompensas.component.html',
  styleUrls: ['view-recompensas.component.css']

})
export class RecompensasComponent implements OnInit {
  public recompensas: Recompensas[] = [];

  constructor(private recompensaService: RecompensasService) { }

  ngOnInit() {
    this.recompensaService.getRecompensas().subscribe(
      (response) => {
        this.recompensas = response;
        console.log(this.recompensas);
      }
    );
  }
}