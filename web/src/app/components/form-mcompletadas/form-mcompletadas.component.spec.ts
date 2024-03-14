import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormMcompletadasComponent } from './form-mcompletadas.component';

describe('FormMcompletadasComponent', () => {
  let component: FormMcompletadasComponent;
  let fixture: ComponentFixture<FormMcompletadasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormMcompletadasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FormMcompletadasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
