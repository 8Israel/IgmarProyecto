import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NuevoFormularioMisionComponent } from './nuevo-formulario-mision.component';

describe('NuevoFormularioMisionComponent', () => {
  let component: NuevoFormularioMisionComponent;
  let fixture: ComponentFixture<NuevoFormularioMisionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [NuevoFormularioMisionComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(NuevoFormularioMisionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
