import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { InventarioService } from '../../services/inventario.service';
import { Router } from '@angular/router';
import { Armas } from '../../interfaces/armas';
import { ArmasService } from '../../services/armas.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-form-inventario',
  standalone: true,
  imports: [FormsModule,CommonModule],
  templateUrl: './form-inventario.component.html',
  styleUrl: './form-inventario.component.css'
})
export class FormInventarioComponent implements OnInit{
  user_id!: Number;
  armas_id!: Number;
  heroes_id!: Number;
  armas:Armas[] =[]

  constructor(private is:InventarioService, private router: Router,private as:ArmasService) { }
  ngOnInit(): void {

    this.as.getArmas().subscribe(
      (response)=>{
        this.armas = response;
        console.log(this.armas);
      }
    )
    
  }

  EditarInventario() {
      this.is.putInventario(this.armas_id, this.heroes_id).subscribe(

        (response)=>{

          console.log(response);
         

        }


      )


  }
}
