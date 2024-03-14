import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormClanesComponent } from './form-clanes.component';

describe('FormClanesComponent', () => {
  let component: FormClanesComponent;
  let fixture: ComponentFixture<FormClanesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormClanesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FormClanesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
