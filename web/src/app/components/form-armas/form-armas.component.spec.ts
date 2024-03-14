import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormArmasComponent } from './form-armas.component';

describe('FormArmasComponent', () => {
  let component: FormArmasComponent;
  let fixture: ComponentFixture<FormArmasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormArmasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FormArmasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
