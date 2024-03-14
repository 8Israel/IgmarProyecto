import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormRecompensasComponent } from './form-recompensas.component';

describe('FormRecompensasComponent', () => {
  let component: FormRecompensasComponent;
  let fixture: ComponentFixture<FormRecompensasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormRecompensasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FormRecompensasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
