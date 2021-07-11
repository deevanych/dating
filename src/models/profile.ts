export interface ProfileType {
  id: number,
  name: string,
  age: number,
  status: string,
  photos: string[],
}

export class Profile implements ProfileType {
  public readonly id!: number

  public readonly name!: string

  public readonly age!: number

  public readonly status!: string

  public readonly photos!: string[]

  constructor(
    id: number,
    name: string,
    age = 50,
    status = 'test',
    photos: string[] = [],
  ) {
    this.id = id;
    this.name = name;
    this.age = age;
    this.status = status;
    this.photos = photos;
  }
}
