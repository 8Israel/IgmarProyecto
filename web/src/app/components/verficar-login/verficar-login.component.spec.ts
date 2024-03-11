import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VerficarLoginComponent } from './verficar-login.component';

describe('VerficarLoginComponent', () => {
  let component: VerficarLoginComponent;
  let fixture: ComponentFixture<VerficarLoginComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [VerficarLoginComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(VerficarLoginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
