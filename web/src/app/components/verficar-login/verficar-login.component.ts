import { Component } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Router } from '@angular/router';

@Component({
  selector: 'app-verficar-login',
  standalone: true,
  imports: [],
  templateUrl: './verficar-login.component.html',
  styleUrl: './verficar-login.component.css'
})
export class VerficarLoginComponent {

  constructor(private router: Router, private title: Title) { 
    this.title.setTitle('Verificacion')
  }


  onSubmit(codigo: Number) {

  }

}
