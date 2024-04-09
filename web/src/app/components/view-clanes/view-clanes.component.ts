import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { ClanesService } from '../../services/clanes.service';
import { Clanes } from '../../interfaces/clanes';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-view-clanes',
  standalone: true,
  imports: [ FormsModule, NavbarComponent, CommonModule, RouterLink ],
  templateUrl: './view-clanes.component.html',
  styleUrl: './view-clanes.component.css'
})
export class ViewClanesComponent implements OnInit {

  constructor(private cs: ClanesService) { }

  public clanes: Clanes[] = []
  public selectedClan: Clanes = {
    id: 0,
    activate: false,
    name: '',
    lider: 0,
    nivel_clan: 0,
    nombre: ''
  }

  ngOnInit(): void {
      this.cs.getClanes().subscribe(
        (response) => {
          this.clanes = response
          console.log(response)
        }
      )
  }

  deleteClan(id: Number){
    this.cs.deleteClan(id).subscribe(
      (response) => {

      },
      (error) => {
        
      }
    )
  }

}
