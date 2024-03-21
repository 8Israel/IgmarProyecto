import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewClanesComponent } from './view-clanes.component';

describe('ViewClanesComponent', () => {
  let component: ViewClanesComponent;
  let fixture: ComponentFixture<ViewClanesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewClanesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewClanesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
