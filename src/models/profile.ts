export interface ProfileType {
  id: number,
  name: string,
  age: number,
  status: string,
  avatar: string,
}

export class Profile implements ProfileType {
  public readonly id!: number

  public readonly name!: string

  public readonly age!: number

  public readonly status!: string

  public readonly avatar!: string

  constructor(
    id: number,
    name: string,
    age = 50,
    status = 'test',
    avatar = 'https://placeimg.com/600/300/people',
  ) {
    this.id = id;
    this.name = name;
    this.age = age;
    this.status = status;
    this.avatar = avatar;
  }
}
