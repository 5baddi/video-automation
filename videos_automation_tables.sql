/* Custom templates */
create table if not exists VA_Custom_templates(
	id int primary key AUTO_INCREMENT,
    vau_id int unsigned unique not null,
    name varchar(100) unique not null,
    package varchar(255) default null,
    version varchar(25) default null,
    rotation varchar(25) not null default 'square',
    preview_path varchar(255) default null,
    updated_at timestamp default null on update CURRENT_TIMESTAMP,
    created_at timestamp not null default CURRENT_TIMESTAMP
);

/* Template medias */
create table if not exists VA_Template_medias(
	id int primary key AUTO_INCREMENT,
    template_id int unsigned not null,
    placeholder varchar(255) not null,
    type varchar(25) not null default 'image',
    color varchar(25) default null,
    default_path varchar(255) default null,
    position int unsigned not null default 1,
    updated_at timestamp default null on update CURRENT_TIMESTAMP,
    created_at timestamp not null default CURRENT_TIMESTAMP,

    foreign key (template_id) references VA_Custom_templates(id)
);

/* Render jobs */
create table if not exists VA_Render_jobs(
	id int primary key AUTO_INCREMENT,
    template_id int unsigned not null,
    vau_job_id int unsigned unique not null,
    status varchar(25) not null,
    message varchar(255) default null,
    output_url varchar(255) default null,
    progress int default 0,
    left_seconds int default 0,
    updated_at timestamp default null on update CURRENT_TIMESTAMP,
    created_at timestamp not null default CURRENT_TIMESTAMP,

    foreign key (template_id) references VA_Custom_templates(id)
);